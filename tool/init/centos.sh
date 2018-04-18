#!/bin/bash
SCP_DIR=$(cd $(dirname $0);pwd);
#cd $SCP_DIR/../../

error () {
    echo "ERROR : $1"
    echo "the script is failed"
    exit -1
}

ttrweb () {
    sudo git clone https://github.com/simpart/ttr-web4php.git $SCP_DIR/../../work/ttr-web
    sudo $SCP_DIR/../../work/ttr-web/tool/setup/php.sh
    sudo $SCP_DIR/../../work/ttr-web/tool/setup/httpd.sh $SCP_DIR/../../../ dr-pkt
    sudo $SCP_DIR/../../work/ttr-web/tool/setup/mongo.sh
    sudo systemctl restart httpd    
}

#install_uuid () {
#    yum install -y libuuid-devel
#    pecl install uuid
#    EXT_TXT="extension=uuid.so"
#    INI_PATH="/etc/php.ini"
#    if [ ! -f $INI_PATH ]; then
#        error "could not found php.ini"
#    fi
#
#    CHK_EXT=$(cat $INI_PATH | grep $EXT_TXT)
#    if [[ "" == ${CHK_EXT} ]]; then
#        echo -e "\n*** add extension to php.ini ***\n"
#        echo $EXT_TXT >> $INI_PATH
#    fi
#    
#    sudo systemctl restart httpd
#}


echo "*** setup dr-pkt"
ttrweb

if [ ! -f $SCP_DIR/../../src/php/ttr/require.php ]; then
    echo -e " ** install tetraring4php"
    git clone https://github.com/simpart/tetraring4php.git $SCP_DIR/../../src/php/ttr
    if [ $? != 0 ]; then
        error "could not clone github.com/simpart/tetraring4php.git"
    fi
fi

sudo php $SCP_DIR/../../src/php/usr/init.php

echo "*** successful setup dr-pkt"
