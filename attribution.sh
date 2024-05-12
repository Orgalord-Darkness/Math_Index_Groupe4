#!/bin/bash

OLD_NAME="Heddy Mameri"
NEW_NAME="Orgalord-Darkness"
OLD_EMAIL="Heddy.mameri@lyceestvincent.fr"
NEW_EMAIL="heddy.mameri@gmail.com"

git filter-branch -f --env-filter "
if [ \"\$GIT_COMMITTER_EMAIL\" = \"$OLD_EMAIL\" ]; then
    export GIT_COMMITTER_NAME=\"$NEW_NAME\"
    export GIT_COMMITTER_EMAIL=\"$NEW_EMAIL\"
fi
if [ \"\$GIT_AUTHOR_EMAIL\" = \"$OLD_EMAIL\" ]; then
    export GIT_AUTHOR_NAME=\"$NEW_NAME\"
    export GIT_AUTHOR_EMAIL=\"$NEW_EMAIL\"
fi
" --tag-name-filter cat -- --branches --tags

