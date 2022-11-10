theme=$1
if [ ! -z "$theme" -a "$theme" != " " ]; then
        echo "theme to pack $theme "
        zip -r "$theme.zip" $theme
fi
