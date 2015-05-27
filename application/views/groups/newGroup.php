<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="BoardContainer">
    
    <form class="" action="newGroupController/createGroup/" method="post">
        <div class="GroupName">
            <input type="text" name="groupName" size="50" placeholder="name of the group..."/>
        </div>


        <div class="AddMember">
            <input type="text" class="" name="member" placeholder="first member...">
            <input class="" type="button" value="add" onclick="" />
            <br /><br />
            <div class="">
                <input class="" type="submit" value="create" />
            </div>
        </div>
    </form>
    
    <div class="Members">
        Members of the group...
        <textarea size="50" rows="20" name="members" >

        </textarea>
        
    </div>
    
</div>
