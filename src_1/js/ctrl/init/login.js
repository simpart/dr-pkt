/**
 * @file login.js
 * @brief login page
 */
let mf = require('mofron');
/* component */
let Login = require('mofron-comp-login');
/* app ctrl */
let auth  = require('../auth.js');
let theme = require('../../conf/theme.js');

/**
 * page init function
 *
 * @param rt : root component
 */
let start = (rt) => {
    try {
        /* init main page */
        rt.addChild(
            new Login({
                title    : 'APP Name',
                authConf : new mf.Param(
                               'auth uri here',
                               auth.auth
                           )
            })
        ); 
    } catch (e) {
        console.error(e.stack);
        throw e;
    }
}


try {
    require('expose-loader?app!../../conf/namesp.js');
    theme.theme(app.root.theme());
    start(app.root);
    app.root.visible(true);
} catch (e) {
    console.error(e.stack);
}
/* end of file */
