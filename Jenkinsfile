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
                sh 'rsync -azP --exclude .git --exclude .gitignore --exclude bitbucket-pipelines.yml . $DEPLOY_USER@$DEPLOY_HOST:/mnt/data/gbox/app'
            }
        }
    }
}