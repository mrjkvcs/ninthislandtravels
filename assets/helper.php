<?php

/**
 * @param $mystring
 * @param string $findme
 * @return bool
 */
function findMe($mystring, $findme = 'choosepuppy.com')
{
    $pos = strpos($mystring, $findme);
    if ($pos === false)
    {
        return false;
    } else
    {
        return true;
    }
}

function flash()
{
    if ( (! isset($_SESSION['success'])) && (! isset($_SESSION['unSuccess']))) return '';

    if (isset($_SESSION['success']))
    {
        unset($_SESSION['success']);
        $style = 'success';
        $text = 'Success';
    }
    if (isset($_SESSION['unSuccess']))
    {
        unset($_SESSION['unSuccess']);
        $style = 'danger';
        $text = 'Something went wrong';
    }

    echo '
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="alert alert-' . $style . '">' . $text . '</div>
        </div>
    </div>';

}

function auto_version($file)
{
    if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
        return $file;

    $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
    return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}
