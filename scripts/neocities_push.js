const dotenv = require('dotenv').config() // set BASE_DIR and AUTH (api key or USERNAME:PASSWORD iirc) in .env
const axios = require('axios') //i pro8ly didnt need this 8ut too L8 ::::3
const Formdata = require('form-data')

const fs = require('fs')
const { readdir } = require('fs').promises
const crypto = require('crypto')

const pRecursiveList = async (dir) => {
    let files = []
    const items = await readdir(dir, { withFileTypes: true })
    for (const item of items) {
        files.push([item, dir + '/' + item.name])
        if (item.isDirectory()) {
            files = [
                ...files,
                ...(await pRecursiveList(dir + '/' + item.name)),
            ]
        }
    }
    return (await Promise.resolve(files))
} //Shameless stolen from https://www.webmound.com/nodejs-get-files-in-directories-recursively/

const pLocalList = async (dir) => {
    return pRecursiveList(dir).then(list => {
        let files = {}
        for (const item of list) {
            let path = item[1].replace("./", "")
            let is_directory = item[0].isDirectory()
            let sha1_hash
            let file_info = {
                "is_directory": is_directory, // is directory
            }
            if (!is_directory) {
                const fileBuffer = fs.readFileSync(path);
                const hashSum = crypto.createHash('sha1');
                hashSum.update(fileBuffer);
                sha1_hash = hashSum.digest('hex');
                file_info["sha1_hash"] = sha1_hash
            }
            files = {
                ...files,
                [path]: file_info,
            }
        }
        return files
    })
}
const pNeocitiesList = async () => {
    return axios.get('https://neocities.org/api/list', {
        headers: {
            Authorization: "Bearer " + process.env.API_KEY,
        }
    }).then(response => {
        transformed_data = {}
        for (const f in response.data["files"]) {
            transformed_data = {
                ...transformed_data,
                [response.data["files"][f]["path"]]: {
                    "is_directory": response.data["files"][f]["is_directory"],
                    "sha1_hash": response.data["files"][f]["sha1_hash"],
                },
            }
        }
        /* i wanna it 2 look like Dis
        {
            'foo.html' : {"is_directory": false, "sha1_hash": "Str34mS41NT4NG3R8unchaNum8ers"},
            8ar: {"is_directory": true}
        }
         so its easier 2 deal with l8er watever u Getit */
        return (transformed_data)
    }).catch(error => {
        //console.log(error)
    })
}

const pUpload = async (filepaths) => {
    //send a POST request to /api/upload using a form with the file name and a stream of the file data attached to it
    //like this: form.append(files[i].name, fs.createReadStream(files[i].path))
    const form = new Formdata()
    for (f in filepaths) {
        let name = filepaths[f].split("/").pop() //this does mean u cant use '/' in the filename 8ut whatever Who Care
        let stream = fs.createReadStream(filepaths[f])
        form.append(name, stream, filepaths[f])
    }
    //now just send a form with form.getHeaders()
    return axios({
        method: 'post',
        url: 'https://neocities.org/api/upload',
        headers: {
            ...form.getHeaders(),
        },
        auth: process.env.NC_USER + ':' + process.env.NC_PASS,
    }).then(response => {
        console.log(response.data)
        return (response)
    }).catch(error => {
        console.log(error)
    })
}

const pDelete = async (filepaths) => {
    const form = new Formdata()
    for (f in filepaths) {
        form.append('filenames[]', filepaths[f])
    }
    return axios({
        method: 'post',
        url: 'https://neocities.org/api/delete',
        headers: {
            ...form.getHeaders(),
        },
        auth: process.env.NC_USER + ':' + process.env.NC_PASS,
    }).then(response => {
        console.log(response.data)
        return (response)
    }).catch(error => {
        console.log(error)
    })
}

/*  =======================================================================
    fuckin do it 
    =====================================================================*/

process.chdir(process.env.BASE_DIR) // cwd to the one what has the files u wanna upload (set in .env)

Promise.all([pLocalList('.'), pNeocitiesList()]).then(twoofthem => {
    // we get an O8ject containing 8oth our locally stored file list and the remote file list [0 and 1]
    // filter out any files that match (files that havent changed since last push, so the hash is the same),
    // and upload / delete all the remaining ones, respectively
    for (const f in twoofthem[0]) {
        //does this file exist, and do the hashes match?
        if (twoofthem[1][f]["sha1_hash"] == twoofthem[0][f]["sha1_hash"]) {
            delete twoofthem[0][f] //i.e. dont upload this file
            delete twoofthem[1][f] //i.e. dont delete this file
        }
    }
    console.log(twoofthem)
    return (twoofthem)
}).then(twoofthem => {
    pDelete(Object.keys(twoofthem[1]))
    return twoofthem
}).then(twoofthem => {
    pUpload(Object.keys(twoofthem[0]))
})