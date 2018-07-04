pipeline {
    agent { docker { image 'php' } }
    stages {
        stage('build') {
            steps {
                sh 'php --version'
                sh '''
                    echo "PHP is installed"
                '''
            }
        }
        stage('deploy') {
            steps {
                sh 'Now deploying to $DEPLOY_HOST'
            }
        }
    }
}