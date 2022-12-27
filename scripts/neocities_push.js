// get all the hashes from neocities / delete any that dont match the ones of the local version / push the rest

const dotenv = require('dotenv').config() // include .env file (API_KEY or NC_USER/NC_PASS for authorization)
const axios = require('axios')
const fs = require('fs')
const { readdir } = require('fs').promises;
const crypto = require('crypto')

process.chdir(process.env.BASE_DIR) // cwd to the one what has the files u wanna upload (set in .env)

const getFileList = async (dir) => {
    let files = []
    const items = await readdir(dir, { withFileTypes: true })
    for (const item of items) {
        files.push([item, dir + '/' + item.name])
        if (item.isDirectory()) {
            files = [
                ...files,
                ...(await getFileList(dir + '/' + item.name)),
            ]
        }
    }
    return (files)
} //shameless Stolen from https://www.webmound.com/nodejs-get-files-in-directories-recursively/

getFileList('.').then(list => {
    let files = []
    for (const item of list) {
        let path = item[1].replace("./", "")
        let is_directory = item[0].isDirectory()
        let sha1_hash
        let file_info = {
            "path":path,
            "is_directory":is_directory,
        }
        if (!is_directory) {
            const fileBuffer = fs.readFileSync(path);
            const hashSum = crypto.createHash('sha1');
            hashSum.update(fileBuffer);
            sha1_hash = hashSum.digest('hex');
            file_info.sha1_hash = sha1_hash
        }

        files.push(file_info)
    }
    console.log(files)
}).then(files => {
})


//var apiurl = 'https://' + process.env.API_KEY + "@neocities.org/api/list"
/* commented to not spam neocities api
axios.get('https://neocities.org/api/list', { 
    headers: {"Authorization":"Bearer "+process.env.API_KEY}
}).then(function (response) {
    console.log("Response"+JSON.stringify(response.data))
    for (const file in response.data.files) {

    }

}).catch(function (error) {
    console.log("Error"+error) 
}).finally(function () {

}) */ 