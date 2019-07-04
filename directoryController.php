public class Directory{

  public function getFolders(Request $request){
        $folders = ProjectFolder::where('parent_id',$request->id)->where('project_id',$request->project_id)->where('is_active',1)->get();
        $parent = ProjectFolder::where('id',$request->id)->where('is_active',1)->first();
        $parentid = 0;
        $path = '';
        if($parent){
            $parentid = $parent->parent_id;
            $pid = $parent->id;
            while(1){
                $p = DB::table('project_folders')->where('id','=',$pid)->first();
                if($p){
                    $path = ' / '.$p->folder_name.$path;
                    $pid = $p->parent_id;
                }else{
                    break;
                }
            }
        }
        return response()->json(array('folders'=>$folders,'parentid'=>$parentid,'path'=>$path));
    }

}
