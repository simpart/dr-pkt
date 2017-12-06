#!/bin/bash
SCP_DIR=$(cd $(dirname $0);pwd);
cd $SCP_DIR/../
WEBPACK=node_modules/.bin/webpack

main_pack () {
    echo $($WEBPACK --config conf/webpack/webpack.main.config.js);
}

login_pack () {
    echo $($WEBPACK --config conf/webpack/webpack.login.config.js);
}

if [ -n "$1" ]; then
    if [ $1 = "main" ]; then
        main_pack
    elif [ $1 = "login" ]; then
        login_pack
    fi
else
    main_pack
    login_pack
fi
