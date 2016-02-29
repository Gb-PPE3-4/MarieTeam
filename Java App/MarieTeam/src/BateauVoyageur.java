import java.util.*;


public class BateauVoyageur extends Bateau {
	
	private String vitesseBatVoy ;
	private String imageBatVoyageur ;
	private ArrayList<Equipement> collEquip = new ArrayList<Equipement>() ;
	
	// Constructeur VIDE
	public BateauVoyageur() {
		super();
		vitesseBatVoy = new String() ;
		imageBatVoyageur = new String() ;
		collEquip = new ArrayList<Equipement>() ;
	}

	// Constructeur avec SUPER, VITESSE, IMG
	public BateauVoyageur(int unId, String unNom, String uneLongeur,String uneLargeur, int unHeritage,String uneVitesse,String uneImage,ArrayList uneCollEquip) {
		super(unId, unNom, uneLongeur, uneLargeur, unHeritage);
		vitesseBatVoy = uneVitesse;
		imageBatVoyageur = uneImage ;
		collEquip = uneCollEquip ;
	}

	// Renvoie une chaine appropriee pour le PDF avec tous les attributs BVOYAGEUR avec SUPER
	public String toString(){
		String resultat = new String() ;
		String mot1 = "Vitesse : " + vitesseBatVoy + " noeuds." ; 
		String mot2 = "Liste des équipements du bateau : " ; 
		String Newligne =  System.getProperty("line.separator") ;
		
		resultat = super.toString() + Newligne + mot1 + Newligne + mot2 ; 
		
		// Recuperation des equipements
		for( Equipement unEquipement : collEquip ){
			String mot3 = unEquipement.toString();
			resultat = resultat + Newligne + mot3;
		}
		
		return resultat ;
	}
	
	// Getters & Setters
	
	public String getVitesse() {
		return vitesseBatVoy;
	}

	public void setVitesse(String vitesse) {
		this.vitesseBatVoy = vitesse;
	}

	public String getImageBatVoyageur() {
		return imageBatVoyageur;
	}

	public void setImageBatVoyageur(String imageBatVoyageur) {
		this.imageBatVoyageur = imageBatVoyageur;
	}

	public ArrayList<Equipement> getCollEquip() {
		return collEquip;
	}

	public void setCollEquip(ArrayList<Equipement> collEquip) {
		this.collEquip = collEquip;
	}
}
