pipeline {
  agent {
    docker {
      image 'php'
    }

  }
  stages {
    stage('build') {
      steps {
        sh 'php --version'
        sh '''
                    echo "PHP is installed"
                '''
      }
    }
  }
  environment {
    DEPLOY_HOST = '122.155.186.24'
    DEPLOY_USER = 'root'
  }
}