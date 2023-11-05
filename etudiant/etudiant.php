<?php

class etudiantù
{
    private $bdd;
    private $nom;
    private $age;
    private $adresse;
    private $date_de_naissance;
    public function ajouter_etudiant(){
        $this->bdd=new PDO('mysql:host=localhost;dbname=etudiant', 'root', '');
        if (isset($_POST['modifier'])){
            $valeur_modifier=$this->bdd->prepare('SELECT * FROM etudiant WHERE id=:id');
            $valeur_modifier->execute(array('id'=>$_POST['id']));
            $valeur=$valeur_modifier->fetch();
        }
        ?>
        <form method="post" action="index.php">
            <input type="hidden" name="id" value="<?php if (isset($valeur)){echo $valeur['id'];}?>" required class="form-control-sm">
            <input type="text" name="nom" placeholder="Nom" <?php if (isset($valeur)){echo 'value="' . $valeur['nom'] . '"';}?> required class="form-control-sm"><br>
            <input type="number" name="age" placeholder="Age" <?php if (isset($valeur)){echo 'value="' . $valeur['age'] . '"';}?> class="form-control-sm" required><br>
            <input type="text" name="adresse" placeholder="Adresse" <?php if (isset($valeur)){echo 'value="' . $valeur['adresse'] . '"';}?> required class="form-control-sm"><br>
            <input type="date" name="date_de_naissance" placeholder="Date de naissance" <?php if (isset($valeur)){echo 'value="' . $valeur['date_de_naissance'] . '"';}?> class="form-control-sm"required><br>
            <input type="submit" <?php if (isset($_POST['modifier'])){echo 'name="enregistrer"';} else{echo 'name="ajouter"';}?> value="Ajouter" class="btn btn-primary">
        </form>

        <?php
        if (isset($_POST['ajouter'])){
            $this->nom=$_POST['nom'];
            $this->age=$_POST['age'];
            $this->adresse=$_POST['adresse'];
            $this->date_de_naissance=$_POST['date_de_naissance'];
            $nouveau_etudiant = $this->bdd->prepare('INSERT INTO etudiant(nom, age, adresse, date_de_naissance)
            VALUES (:nom, :age, :adresse,:date_de_naissance)');
            $nouveau_etudiant->execute(array(
                'nom'=>$this->nom,
                'age'=>$this->age,
                'adresse'=>$this->adresse,
                'date_de_naissance'=>$this->date_de_naissance
            ));
            header('Location:index.php');
        }
        if (isset($_POST['enregistrer'])){
            $this->nom=$_POST['nom'];
            $this->age=$_POST['age'];
            $this->adresse=$_POST['adresse'];
            $this->date_de_naissance=$_POST['date_de_naissance'];
            $id=$_POST['id'];
            $update_etudiant=$this->bdd->prepare('UPDATE etudiant SET nom=:nom, age=:age, adresse=:adresse, date_de_naissance=:date_de_naissance WHERE id=:id');
            $update_etudiant->execute(array(
                'nom'=>$this->nom,
                'age'=>$this->age,
                'adresse'=>$this->adresse,
                'date_de_naissance'=>$this->date_de_naissance,
                'id'=>$id));
            header('Location:index.php');
        }
    }
    public function afficher_liste_etudiant(){
        $this->bdd = new PDO('mysql:host=localhost;dbname=Etudiant', 'root', '');
        $liste_etudiant = $this->bdd->query('SELECT * FROM Etudiant');
        ?>
        <div style="display: grid; grid-template-columns: repeat(6, 1fr); margin-top: 20px" class="border border-primary ">
            <p class="btn-primary">Identifiant</p>
            <p class="btn-primary">Nom</p>
            <p class="btn-primary">Age</p>
            <p class="btn-primary">Adresse</p>
            <p class="btn-primary">Date de naissance</p>
            <p class="btn-primary"></p>
            <?php
            while ($valeur=$liste_etudiant->fetch()){
                ?>
                <p><?php echo $valeur['id'];?></p>
                <p><?php echo $valeur['nom'];?></p>
                <p><?php echo $valeur['age'];?></p>
                <p><?php echo $valeur['adresse'];?></p>
                <p><?php echo $valeur['date_de_naissance'];?></p>
                <div>
                    <form method="post" action="index.php">
                        <input type="hidden" name="id" value="<?php echo $valeur['id'];?>">
                        <input type="submit" name="modifier" value="modifier" class="btn btn-success">
                        <input type="submit" name="supprimer" value="Supprimer" class="btn-danger btn">
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        if (isset($_POST['supprimer'])){
            $supprimer_etudiant= $this->bdd->prepare('DELETE FROM Etudiant WHERE id=:id');
            $supprimer_etudiant->execute(array('id'=>$_POST['id']));
            header('Location:index.php');
        }
    }
}