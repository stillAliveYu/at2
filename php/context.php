<?php
//the ids of sessions of context
class SessionId {

    //using in view a paint
    public function currentModalDataSessionId(){
        return 'currentModalDataSession';
    }

    //using in updating
    public function currentEditFormDataSessionId(){
        return 'currentFormDataSession';
    }
    //using in getting the whole gallery
    public function galleryDataSessionId(){
        return 'gallerySession';
    }

    //using in insert.php
    public function newPaintDataSessionId(){
        return 'newPaintSession';
    }

    //using in gallery.php and update.php
    public function editFormDataSessionId(){
        return 'editPaintSession';
    }

    public function deletePaintDataSessionId(){
        return 'deletePaintSession';
    }

    public function editModalDataSessionId(){
        return 'editModalSession';
    }

    public function viewModalDataSessionId(){
        return 'viewModalSession';
    }

    public function deleteModalDataSessionId(){
        return 'deleteModalSession';
    }
}

//the session of current modal

class PaintModal{
    public function constructModalData($paint){
        
        //return array($paint['name'],$paint['artist'],$paint['img'],$paint['style'],$paint['year']);
        return array($paint['id'],$paint['name'],$paint['year'],$paint['media'],$paint['artist'],$paint['style'],$paint['img']);
    }

    
}
//the session of galleryTable

//the session of new paint

//the session of delete paint

//the session of edit modal

//the session of delete modal

//the session of view modal





?>