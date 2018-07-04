pipeline {
    agent { docker { image 'php' } }
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