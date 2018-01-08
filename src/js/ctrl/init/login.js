/**
 * @file main.js
 * @brief 
 */
let mf   = require('mofron');
/* component */
let Login = require('mofron-comp-login');
/* effect */
let Shadow = require('mofron-effect-shadow');
/* function */

let start = (rt) => {
    try {
        let login = new Login({
            title    : 'Dr.Pkt',
//            authConf : new mf.Param(
//                           './src/php/api/auth/login.php',
//                           auth.login
//                       )
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

let get_conts = () => {
    return new mf.Component({
        layout : [
            new Center(90),
            new Margin('top',30),
        ]
    });
}

let add_hdr = (rt, hdr) => {
    try {
        hdr.execOption({
            title : 'Stock Keeper',
            url   : './'
        });
        rt.addChild(hdr);
    } catch (e) {
        console.error(e.stack);
        throw e;
    }
}

try {
    require('expose-loader?app!../../conf/namesp.js');
    require('../../conf/theme.js');
    start(app.root);
    app.root.visible(true);
} catch (e) {
    console.error(e.stack);
}
/* end of file */
