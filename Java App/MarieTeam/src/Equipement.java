
public class Equipement {
	
	private int idEquip;
	private String libEquip;
	
	// Constructeur avec ID, LIBELLE
	public Equipement(int unIdEquip, String unLibEquip){
		idEquip = unIdEquip ;
		libEquip = unLibEquip ;
	}
	
	// Renvoie une chaine appropriee pour le PDF avec le libelle EQUIPEMENT
	public String toString(){
		String resultat = new String() ;
		if(this.libEquip != "" && this.libEquip != null){
			resultat = " - " + libEquip ;
		}
		return resultat;
	}
		
	// Getters & Setters
	
	public int getIdEquip() {
		return idEquip;
	}

	public void setIdEquip(int idEquip) {
		this.idEquip = idEquip;
	}

	public String getLibEquip() {
		return libEquip;
	}

	public void setLibEquip(String libEquip) {
		this.libEquip = libEquip;
	}
}
