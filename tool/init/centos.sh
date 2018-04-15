#!/bin/bash
SCP_DIR=$(cd $(dirname $0);pwd);
cd $SCP_DIR/../../

error () {
    echo "ERROR : $1"
    echo "init.sh is failed"
    exit -1
}

init_base () {
    sudo yum -y update
    sudo yum install git
    
}

del_file () {
    sudo rm -rf ./git
    if [ $? != 0 ]; then
        error "could not delete ./git"
    fi
    
    rm -rf ./src/js/app/.dmy
    rm -rf ./src/js/comp/.dmy
    rm -rf ./html/.dmy
    rm -rf ./img/.dmy
    rm -rf ./font/.dmy
}

build_mofron_env () {
    sudo yum install -y epel-release
    sudo yum install -y nodejs npm
    npm install mofron mofron-comp-login mofron-effect-shadow
    if [ $? != 0 ]; then
        error "could not install mofron"
    fi
    
    echo `./tool/build.sh`
    if [ $? != 0 ]; then
        error "could not install mofron"
    fi
}

ttrweb () {
    
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

install_mongo () {
    cat $SCP_DIR/../tmpl/mongodb.repo >  /etc/yum.repos.d/mongodb.repo
    yum install -y mongodb-org
    systemctl enable mongod
    systemctl start mongod
    
    yum --enablerepo=epel,remi,remi-php70 install php70-php-pecl-mongodb
    
    EXT_TXT="extension="$(find / -name "mongodb.so")
    INI_PATH="/etc/php.ini"
    if [ ! -f $INI_PATH ]; then
        error "could not found php.ini"
    fi

    CHK_EXT=$(cat $INI_PATH | grep $EXT_TXT)
    if [[ "" == ${CHK_EXT} ]]; then
        echo -e "\n*** add extension to php.ini ***\n"
        echo $EXT_TXT >> $INI_PATH
    fi
}

init_mongo () {
    mongo
    use drpkt
    quit()
}

del_file
build_mofron_env
ttrweb
install_uuid
install_mongo
init_mongo


echo "initialized mofron env"




