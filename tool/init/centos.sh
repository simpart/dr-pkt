#!/bin/bash
SCP_DIR=$(cd $(dirname $0);pwd);
#cd $SCP_DIR/../../

error () {
    echo "ERROR : $1"
    echo "the script is failed"
    exit -1
}

mofron_env () {
    sudo git clone https://github.com/mofron/env-template.git $SCP_DIR/../../work/env-template
    sudo $SCP_DIR/../../work/env-template/tool/init/centos/node.sh
    sudo $SCP_DIR/../../work/env-template/tool/init/mofron.sh mofron-comp-login mofron-effect-shadow
    sudp mv $SCP_DIR/../../work/env-template/node_modules $SCP_DIR/../../
}

ttrweb () {
    sudo git clone https://github.com/simpart/ttr-web4php.git $SCP_DIR/../../work/ttr-web
    sudo $SCP_DIR/../../work/ttr-web/tool/setup/php.sh
    sudo $SCP_DIR/../../work/ttr-web/tool/setup/httpd.sh $SCP_DIR/../../../ dr-pkt
    sudo $SCP_DIR/../../work/ttr-web/tool/setup/mongo.sh
}

install_uuid () {
    yum install libuuid-devel
    pecl install uuid
    EXT_TXT="extension=uuid.so"
    INI_PATH="/etc/php.ini"
    if [ ! -f $INI_PATH ]; then
        error "could not found php.ini"
    fi

    CHK_EXT=$(cat $INI_PATH | grep $EXT_TXT)
    if [[ "" == ${CHK_EXT} ]]; then
        echo -e "\n*** add extension to php.ini ***\n"
        echo $EXT_TXT >> $INI_PATH
    fi
    
    systemctl restart httpd
}


echo "*** setup dr-pkt"
mofron_env
ttrweb
install_uuid


echo "successful setup dr-pkt"
