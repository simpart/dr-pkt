/**
 * @file theme.js
 */
let mf = require('mofron');

try {
    let thm = new mf.Theme();
    thm.color(new mf.Color(240,240,240));
    //thm.font();
    
    //thm.component('mofron-comp-login', );
    
    app.root.theme(thm);
} catch (e) {
    throw e;
}
/* end of file */

