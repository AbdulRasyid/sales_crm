<?php

/**
 * @author Boomer
 * @copyright 2015
 */

function pager($class,$id) {
    echo " <div class='$class' id='$id'>
                            <form action=''>
                                <div>
                                <img class='first' src='themes/arrow-stop-180.gif' alt='first'/>
                                <img class='prev' src='themes/arrow-180.gif' alt='prev'/> 
                                <input type='text' class='pagedisplay input-short align-center'/>
                                <img class='next' src='themes/arrow.gif' alt='next'/>
                                <img class='last' src='themes/arrow-stop.gif' alt='last'/> 
                                <select class='pagesize input-short align-center'>
                                    <option value='10' selected='selected'>10</option>
                                    <option value='20'>20</option>
                                    <option value='30'>30</option>
                                    
                                </select>
                                </div>
                            </form>
                        </div>";
}

?>