pipeline {
  agent {
    node {
      label 'swarm'
    }
    
  }
  stages {
    stage('Build') {
      steps {
        sh 'lando start -- -v'
      }
    }
    stage('Static Analysis') {
      steps {
        sh 'lando phplint'
      }
    }
    stage('Sync') {
      steps {
        echo 'Do lando platform stuff'
      }
    }
    stage('Test') {
      steps {
        echo 'lando test stuff'
      }
    }
  }
}