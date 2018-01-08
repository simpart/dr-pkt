/**
 * @file main.js
 * @brief app code before pack
 */
let mf   = require('mofron');
let Text = require('mofron-comp-text');
require('mofron-comp-apphdr');

let AppBase = require('mofron-comp-dev');

let start = (rt) => {
    try {
        let theme  = rt.theme();
        //add_hdr(rt, theme.component('mofron-comp-apphdr'));
        
        //let appbase = theme.component('mofron-comp-centerstyle');
        let base = new AppBase({
            title : 'Dr.Pkt'
            //url   : './'
        });
        rt.addChild(base);
    } catch (e) {
        console.error(e.stack);
        throw e;
    }
}

let add_hdr = (rt, hdr) => {
    try {
        hdr.execOption({
            title : 'Dr.Pkt',
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
