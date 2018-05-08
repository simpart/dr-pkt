/**
 * @file index.js
 * @brief index page initialize
 */
let mf = require('mofron');
require('expose-loader?app!../conf/namesp.js');
require('tetraring4js');

let AppBase = require('mofron-comp-appbase');
let Button = require('mofron-comp-button');
let Text = require('mofron-comp-text');
let Frame = require('mofron-comp-frame');
let Menu = require('mofron-comp-slidemenu');

/* event */
let Click = require('mofron-event-click');
/* effect */
let Shadow = require('mofron-effect-shadow');
let efCent = require('mofron-effect-center');

/* local component */

/* app ctrl */
let theme = require('../conf/theme.js');

let base = {
    tmp : null,
    get : () => {
          try {
              if (null !== base.tmp) {
                  return base.tmp;
              }
              let ret = new AppBase({
                  title     : 'Dr.Pkt',
                  winHeight : true
              });
              ret.header().addEffect(new Shadow(15));
              
              base.tmp = ret;
              return ret;
          } catch (e) {
              console.error(e.stack);
              throw e;
          }
    }
}


let menu = {
    tmp : null,
    get : () => {
        try {
            if (null !== menu.tmp) {
                return menu.tmp;
            }
            
            let ret = new Menu({
                switch : new Button('menu'),
                offset : 100,
                zIndex : 1000,
                height : 100,
                child  : [
                    new Frame(),
                    new Frame()
                ]
                //size : new mf.Param(250, '100%')
            });
            
            menu.tmp = ret;
            return ret;
        } catch (e) {
            console.error(e.stack);
            throw e;
        }
    }
}
/**
 * page init function
 * 
 * @param rc (mf.Component) root component
 */
let start = (rc) => {
    try {
        rc.addChild(base.get());
        base.get().addChild(menu.get());
        
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
