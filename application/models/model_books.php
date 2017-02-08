<?php

    class Model_books extends Model{

        public $id;
        public $name;
        public $email;
        public $description;
        public $image;
        public $is_solved;

        public function __construct($id = null, $name = null, $email = null, $description = null, $image = null, $is_solved = 0){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->description = $description;
            $this->image = $image;
            $this->is_solved = $is_solved;
        }

        public function get_data($id = false){
            parent::get_data();
            $data = [];
            $sql = 'SELECT * FROM books';
            switch($id){
                case 'id_a':
                    $sql .= ' ORDER BY id ASC';
                    break;
                case 'id_d':
                    $sql .= ' ORDER BY id DESC';
                    break;
                case 'name_a':
                    $sql .= ' ORDER BY name ASC';
                    break;
                case 'name_d':
                    $sql .= ' ORDER BY name DESC';
                    break;
                case 'email_a':
                    $sql .= ' ORDER BY email ASC';
                    break;
                case 'email_d':
                    $sql .= ' ORDER BY email DESC';
                    break;
                case 'status_a':
                    $sql .= ' ORDER BY is_solved ASC';
                    break;
                case 'status_d':
                    $sql .= ' ORDER BY is_solved DESC';
                    break;
            }
            $registry = Registry::get_set_Registry();
            if($registry['db']){
                foreach($registry['db']->query($sql) as $index => $item){
                    $data[$index] = new Model_books($item['id'], $item['name'], $item['email'], $item['description'], $item['image'],
                                                    $item['is_solved']);
                }
            }

            return $data;
        }

        public function insert_data($arr){
            //parent::insert_data();
            $registry = Registry::get_set_Registry();
            if($registry['db']){
                $STH = $registry['db']->prepare("INSERT INTO books (name, email, description, image) values (:name, :email, :descr, :image)");
                $STH->execute($arr);
            }
        }

        public function update_data($arr){
            //parent::update_data($arr);
            $registry = Registry::get_set_Registry();
            $array_data = $this->get_data();
            $tmpArray = [];
            foreach($array_data as $item => $array){
                $tmp = [];
                foreach($arr as $key => $index){
                    if($key == 'id-'.$array->id){
                        $tmp['id'] = $index;
                    }elseif($key == 'description-'.$array->id){
                        $tmp['description'] = $index;
                    }elseif($key == 'is_solved-'.$array->id){
                        $tmp['is_solved'] = 1;
                    }
                }
                if(!array_key_exists('is_solved', $tmp)){
                    $tmp['is_solved'] = 0;
                }
                $tmpArray[$item] = $tmp;
            }

            if($registry['db']){
                foreach($tmpArray as $item){
                    try{
                        $sql = "UPDATE books SET description = :description, is_solved = :is_solved WHERE id = :id";

                        $stmt = $registry['db']->prepare($sql);
                        $stmt->bindParam(':description', $item['description'], PDO::PARAM_STR);
                        $stmt->bindParam(':is_solved', $item['is_solved'], PDO::PARAM_STR);
                        $stmt->bindParam(':id', $item['id'], PDO::PARAM_INT);
                        $stmt->execute();
                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }
                }
            }

            return $this->get_data();
        }


        public function resize($file){
            $width = 320;
            $height = 240;

            if($file['type'] == 'image/jpeg'){
                $source = imagecreatefromjpeg($file['tmp_name']);
            }elseif($file['type'] == 'image/png'){
                $source = imagecreatefrompng($file['tmp_name']);
            }elseif($file['type'] == 'image/gif'){
                $source = imagecreatefromgif($file['tmp_name']);
            }else{
                return false;
            }

            $w_src = imagesx($source);
            $h_src = imagesy($source);

            if($w_src > $width || $h_src > $height){
                $ratio_w = $w_src / $width;
                $ratio_h = $h_src / $height;
                $w_dest = round($w_src / $ratio_w);
                $h_dest = round($h_src / $ratio_h);

                $dest = imagecreatetruecolor($w_dest, $h_dest);
                imagecopyresampled($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

                $this->createImage($dest, 'tmp/'.$file['name'], 100, $file['type']);
                imagedestroy($dest);
            }else{
                $this->createImage($source, 'tmp/'.$file['name'], 100, $file['type']);
            }
            imagedestroy($source);

            return $file['name'];
        }

        protected function createImage($file, $path, $quantity, $file_type){
            if($file_type == 'image/jpeg'){
                imagejpeg($file, $path, $quantity);
            }elseif($file_type == 'image/png'){
                imagepng($file, $path);
            }elseif($file_type == 'image/gif'){
                imagegif($file, $path);
            }
        }
    }