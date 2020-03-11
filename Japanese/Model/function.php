<?php 
	/**
	 * 
	 */
	class User
	{
		public $db;	
		function __construct($con)
		{
			if(!isset($this->db)){
				$this->db = $con;
			}
		}
		public function addWord($japanese,$english,$lessonNo,$details,$created){
		    $st = $this->db->prepare("INSERT INTO japanese (japanese,english,lessonNo,pronounciation,created) VALUES (:japanese,:english,:lessonNo,:details,:created)");
		    $st->bindParam(':japanese',$japanese);
		    $st->bindParam(':english',$english);
		    $st->bindParam(':lessonNo',$lessonNo);
		    $st->bindParam(':details',$details);
		    $st->bindParam(':created',$created);
		    $st->execute();
		    return true;
        }
        public function addKanji($kanji,$romaji,$english,$level){
            $st = $this->db->prepare("INSERT INTO kanji (kanji,romaji,english,level) VALUES (:kanji,:romaji,:english,:level)");
            $st->bindParam(':kanji',$kanji);
            $st->bindParam(':romaji',$romaji);
            $st->bindParam(':english',$english);
            $st->bindParam(':level',$level);
            $st->execute();
            return true;
        }
        public function isExistWord($word){
            $st = $this->db->prepare("SELECT * FROM japanese WHERE japanese=:japanese");
            $st->bindParam(':japanese',$word);
            $st->execute();
            if($st->rowCount()){
                return true;
            }
            return false;
        }
        public function isExistKanji($kanji){
            $st = $this->db->prepare("SELECT * FROM kanji WHERE kanji=:kanji");
            $st->bindParam(':kanji',$kanji);
            $st->execute();
            if($st->rowCount()){
                return true;
            }
            return false;
        }
        public function updateWord($japanese,$english,$lessonNo,$details,$updated,$id){
		    $st = $this->db->prepare("UPDATE japanese SET japanese=:japanese, english=:english, lessonNo=:lessonNo, pronounciation=:details, updated=:updated WHERE id=:id");
		    $st->bindParam(':japanese',$japanese);
		    $st->bindParam(':english',$english);
		    $st->bindParam(':lessonNo',$lessonNo);
		    $st->bindParam(':details',$details);
		    $st->bindParam(':updated',$updated);
		    $st->bindParam(':id',$id);
		    $st->execute();
		    return true;
        }
        public function updateKanji($kanji,$romaji,$english,$level,$id){
            $st = $this->db->prepare("UPDATE kanji SET kanji=:kanji, romaji=:romaji, english=:english, level=:level WHERE id=:id");
            $st->bindParam(':kanji',$kanji);
            $st->bindParam(':romaji',$romaji);
            $st->bindParam(':english',$english);
            $st->bindParam(':level',$level);    
            $st->bindParam(':id',$id);
            $st->execute();
            return true;
        }
        public function deleteWord($id){
        	$st = $this->db->prepare("DELETE FROM japanese WHERE id=:id");
        	$st->bindParam(':id',$id);
        	$st->execute();
        	return true;
        }
        public function deleteKanji($id){
            $st = $this->db->prepare("DELETE FROM kanji WHERE id=:id");
            $st->bindParam(':id',$id);
            $st->execute();
            return true;
        }
        public function getWords(){
        	$st = $this->db->prepare("SELECT * FROM japanese");
        	$st->execute();
        	$resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
        	return $resultSet;
        }
        public function getKanjis(){
            $st = $this->db->prepare("SELECT * FROM kanji");
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function getWordsLikeEnglishOrPronounciation($searchWord){
            $st = $this->db->prepare("SELECT * FROM japanese WHERE pronounciation LIKE '$searchWord%' OR english LIKE '$searchWord%'");
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function getWordsByLessonNo($lessonNo){
            $st = $this->db->prepare("SELECT * FROM japanese WHERE lessonNo=:lessonNo");
            $st->bindParam(':lessonNo',$lessonNo);
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function getWordById($id){
        	$st = $this->db->prepare("SELECT * FROM japanese WHERE id=:id");
        	$st->bindParam(':id',$id);
        	$st->execute();
        	$resultSet = $st->fetch(PDO::FETCH_ASSOC);
        	return $resultSet;
        }
        public function getKanjiById($id){
            $st = $this->db->prepare("SELECT * FROM kanji WHERE id=:id");
            $st->bindParam(':id',$id);
            $st->execute();
            $resultSet = $st->fetch(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function getSearchedResults($query){
            $st = $this->db->prepare("SELECT * FROM japanese WHERE pronounciation LIKE '$query%' OR english LIKE '$query%'");
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function selectRandomWord(){
            $st = $this->db->prepare("SELECT * FROM japanese ORDER BY RAND() LIMIT 1");
            $st->execute();
            $resultSet = $st->fetch(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function selectRandomKanji(){
            $st = $this->db->prepare("SELECT * FROM kanji ORDER BY RAND() LIMIT 1");
            $st->execute();
            $resultSet = $st->fetch(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function selectRandomWordByLimit($limit){
            $st = $this->db->prepare("SELECT * FROM japanese ORDER BY RAND() LIMIT $limit");
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function selectRandomKanjiByLimit($limit){
            $st = $this->db->prepare("SELECT * FROM kanji ORDER BY RAND() LIMIT $limit");
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function selectRandomWordByLessonNo($lessonNo){
            $st = $this->db->prepare("SELECT * FROM japanese WHERE lessonNo=:lessonNo ORDER BY RAND() LIMIT 1");
            $st->bindParam(':lessonNo',$lessonNo);
            $st->execute();
            $resultSet = $st->fetch(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function getWordsNumber(){
            $st = $this->db->prepare("SELECT * FROM japanese");
            $st->execute();
            return $st->rowCount();
        }
        public function getKanjisNumber(){
            $st = $this->db->prepare("SELECT * FROM kanji");
            $st->execute();
            return $st->rowCount();
        }
        public function getAllWordsWithLimit($start, $limit){
            $st = $this->db->prepare("SELECT * FROM japanese ORDER BY lessonNo, created LIMIT $start, $limit");
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
        public function getAllKanjisWithLimit($start, $limit){
            $st = $this->db->prepare("SELECT * FROM kanji ORDER BY level DESC, created LIMIT $start, $limit");
            $st->execute();
            $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;
        }
	}
?>