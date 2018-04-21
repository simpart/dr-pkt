/**
 * @file login.js
 * @brief login page initialization
 */
let mf = require('mofron');
require('expose-loader?app!../conf/namesp.js');
/* component */
let Login = require('mofron-comp-login');
/* effect */
let Shadow = require('mofron-effect-shadow');

/* app ctrl */
let theme = require('../conf/theme.js');

/**
 * page init function
 * 
 * @param rt : root component
 */
let start = (rt) => {
    try {
        // page init here
        let login = new Login({
            title    : 'Dr.Pkt',
            authConf : new mf.Param(
                           './api/login',
                           (ret)=>{
                               try {
                                   if (true === ret.message) {
                                       window.location.href = './'
                                   } else {
                                       return 'invalid username or password';
                                   }
                               } catch (e) {
                                   throw e;
                               }
                           }
                       )
        });
        login.header().execOption({
            addEffect : new Shadow(20)
        });
        rt.addChild(login);
        
    } catch (e) {
        console.error(e.stack);
        throw e;
    }
}

try {
    theme.theme(app.root.theme());
    start(app.root);
    app.root.visible(true);
} catch (e) {
    console.error(e.stack);
}
/* end of file */
