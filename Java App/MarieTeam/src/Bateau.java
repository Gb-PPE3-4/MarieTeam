
public class Bateau {
	private int idbateau ;
	private String nom ;
	private String longeurBat ;
	private String largeurBat ;
	private int heritage ;


	// Constructeur avec ID, NOM, LONGUEUR, LARGEUR
	public Bateau(){
		idbateau = 0 ;
		nom = new String() ;
		longeurBat = new String() ;
		largeurBat = new String() ;
	}
	
	// Constructeur avec ID, NOM, LONGUEUR, LARGEUR, HERITAGE
	public Bateau(int unId , String unNom , String uneLongeur , String uneLargeur, int unHeritage){
		idbateau = unId ;
		nom = unNom ;
		longeurBat = uneLongeur ;
		largeurBat = uneLargeur ;
		heritage = unHeritage ;
	}
	
	// Renvoie une chaine appropriee pour le PDF avec tous les attributs BATEAU
	public String toString(){
		String mot1="Nom du bateau : " + nom ; 
		String mot2="Longeur : " + longeurBat + " mètres." ; 
		String mot3="Largeur : " + largeurBat + " mètres." ; 
		String Newligne=System.getProperty("line.separator") ; 
		String resultat = mot1 + Newligne + mot2 + Newligne + mot3 ; 
		return resultat ;
	}

	// Getters & Setters

	public int getIdbateau() {
		return idbateau;
	}

	public void setIdbateau(int idbateau) {
		this.idbateau = idbateau;
	}

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public String getLongeurBat() {
		return longeurBat;
	}

	public void setLongeurBat(String longeurBat) {
		this.longeurBat = longeurBat;
	}

	public String getLargeurBat() {
		return largeurBat;
	}

	public void setLargeurBat(String largeurBat) {
		this.largeurBat = largeurBat;
	}

	public int getHeritage() {
		return heritage;
	}

	public void setHeritage(int heritage) {
		this.heritage = heritage;
	}
}
