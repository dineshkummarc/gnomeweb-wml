<?

class Nav {
	var $navtype;
	var $navdata;
	var $html;

	function addLink($title,$uri,$desc='',$id='') {
		$this->navdata[$title]['uri']=$uri;
		$this->navdata[$title]['desc']=$desc;
		$this->navdata[$title]['id']=$id;
	}

	function returnNav($id='nav-top') {
		if ($this->navdata) {
			$this->html='<ul id='.$id.'>';
			while (list($linkname,$linkdata)=each($this->navdata)) {
				$link_desc='';
				$link_id='';

				if ($linkdata['desc'])
					$link_desc=" title=\"$linkdata[desc]\"";

				if ($linkdata['id'])
					$link_id=' id="'.htmlspecialchars($linkdata[id]).'"';
				else
					$link_id=' id="nav-'.htmlspecialchars(preg_replace("/(\W+)/","",strtolower($linkname))).'"';

				$this->html.='<li'.$link_id.'>'.
				'<a href="'.htmlspecialchars($linkdata['uri']).'"'.$link_desc.'>'.
				htmlspecialchars($linkname)."</a></li>\r";
			}
			$this->html.='</ul>';
		}
		return ($this->html);
	}

}

?>
