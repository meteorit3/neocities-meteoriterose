// get all the hashes from neocities / delete any that dont match the ones of the local version / push the rest

const doenv = require('dotenv').config() // include .env file (NC_USER/NC_PASS for API)
const axios = require('axios');

//var apiurl = 'https://' + process.env.API_KEY + "@neocities.org/api/list"
axios.get('https://neocities.org/api/list', {
    headers: {"Authorization":"Bearer "+process.env.API_KEY}
}).then(function (response) {
    console.log("Response"+response)
}).catch(function (error) {
    console.log("Error"+error) 
}).finally(function () {

})
