docker-compose -f docker_compose.yml down
while getopts "bk" arg
do
  case $arg in
    k)
      echo "Stopped!"
      exit 0
      ;;
    b)
      docker-compose -f docker_compose.yml rm -f
      BUILD="--build"
      ;;
    ?)
      echo "Unknown args $arg... exit..."
      exit 1
      ;;
  esac
done

# Remove previouse environemnt vars files, and Set new environment args (abs dir of the .sh no matter where run .sh)
ENV_FILE=".env"
rm -f $ENV_FILE
CUR_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null && pwd )"
HOST_IP=$(ifconfig | grep "inet " | grep -v 127.0.0.1 | awk '{print $2}' | head -1)

function encode_env {
    echo "$1=${!1}" >> $ENV_FILE
}
encode_env "CUR_DIR"
encode_env "HOST_IP"

# Start service
docker-compose -f docker_compose.yml up $BUILD -d

# Open browser webpages
open http://$HOST_IP:8083