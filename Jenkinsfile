pipeline {
    agent { docker { image 'oneko/php-7.1-node-yarn' } }
    stages {
        stage('build') {
            steps {
                sh 'php --version'
            }
        }
        stage('deploy') {
            steps {
                sh 'Now deploying to host'
            }
        }
    }
}