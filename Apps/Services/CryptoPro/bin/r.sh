!#/bin/sh\n

command=$1' -creatrqst '$2' -exprt -both -km -cont '$3' -nokeygen -dn "'${4}'" '
${command}
echo ${command}