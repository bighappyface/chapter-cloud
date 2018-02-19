FROM eeacms/jenkins-slave

RUN apt-get update
RUN apt-get install -y \
     apt-transport-https \
     ca-certificates \
     curl \
     gnupg2 \
     software-properties-common
RUN curl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo "$ID")/gpg | apt-key add -
RUN add-apt-repository \
    "deb [arch=amd64] https://download.docker.com/linux/$(. /etc/os-release; echo "$ID") \
    $(lsb_release -cs) \
    stable"
RUN apt-get update
RUN wget https://github.com/lando/lando/releases/download/v3.0.0-beta.35/lando-v3.0.0-beta.35.deb && \
    dpkg -i --force-depends lando-v3.0.0-beta.35.deb
RUN apt-get install -f -y

