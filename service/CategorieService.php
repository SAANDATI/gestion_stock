<?php
    namespace service;

    use service\DbConnection;
    use model\Categorie;
    class CategorieService{

        public static function create(Categorie $categorie){
            $libelle = $categorie->getLibelle();

            $stmt = DbConnection::getConnection()->prepare('INSERT INTO categorie(libelle) VALUES(:libelle)');
            $stmt->bindParam(':libelle',$libelle);
            $stmt->execute();
        }

        public static function read(){

            $query = DbConnection::getConnection()->query('SELECT * FROM categorie');
            return $query->fetchAll();

        }

        public static function update(Categorie $categorie){
            $id = $categorie->getId();
            $libelle = $categorie->getLibelle();
            $stmt= DbConnection::getConnection()->prepare('UPDATE categorie SET libelle=:libelle WHERE id=:id');
            $stmt->bindParam(':libelle',$libelle);
            $stmt->bindParam(':id',$id);
            $stmt->execute();

        }
        public static function delete($id){
            $stmt = DbConnection::getConnection()->prepare('DELETE FROM categorie WHERE id=:id');
            $stmt->bindParam(':id',$id);
            $stmt->execute();
        }

    }

?>
