<?php
function alert($message)
{
    echo "<script>alert('$message');</script>";
}

function clog($message)
{
    echo "<script>console.log('$message');</script>";
}

function swal($title, $text, $icon)
{
    // echo "<script>alert('$message');</script>";
    echo "<script type=\"text/javascript\">
        Swal.fire({
            title: '$title',
            text: '$text',
            icon: '$icon',
        });
        
        </script>";
}
?>