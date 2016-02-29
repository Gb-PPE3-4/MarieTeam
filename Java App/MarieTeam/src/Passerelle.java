import java.sql.SQLException;
import java.util.ArrayList;

public class Passerelle {
	
	// Renvoie tous les equipements du bateau dont l'identifiant est passé en parametre
    public ArrayList<Equipement> chargerLesEquipements(int unIdBateau) throws ClassNotFoundException, SQLException{
    	ArrayList<Equipement> lesEquip = new ArrayList<Equipement>();
        jeuEnregistrement jEnr = new jeuEnregistrement("SELECT `er`.idequip, `et`.libequip FROM `equiper` er LEFT JOIN `equipement` et ON er.idequip = et.idequip WHERE `er`.idbateau = " + unIdBateau) ;
        while(!jEnr.fin()){
        	lesEquip.add(new Equipement(Integer.parseInt(jEnr.getValeur("idequip")), jEnr.getValeur("libequip"))) ;
    	}
        jEnr.fermer();
    	return lesEquip;
    }
    
    // Charge une collection de tous les bateaux voyageurs avec leur equipement
    public ArrayList<BateauVoyageur> chargerLesBatVoy() throws SQLException, ClassNotFoundException{
    	ArrayList<BateauVoyageur> lesBateaux = new ArrayList<BateauVoyageur>() ;
    	BateauVoyageur monBatVoy ;
        jeuEnregistrement jEnr = new jeuEnregistrement("SELECT * FROM bateau") ;
        jEnr.suivant() ;
        do{
        	if(Integer.parseInt(jEnr.getValeur("heritage")) == 0){
        		jeuEnregistrement jEnrVoy = new jeuEnregistrement("SELECT * FROM bvoyageur WHERE idbateau =" + jEnr.getValeur("idbateau")) ;
        		jEnrVoy.suivant() ;
        		monBatVoy = new BateauVoyageur(Integer.parseInt(jEnr.getValeur("idbateau")), jEnr.getValeur("nom"), jEnr.getValeur("longueurBat"), jEnr.getValeur("largeurBat"), Integer.parseInt(jEnr.getValeur("heritage")), jEnrVoy.getValeur("vitesseBatVoy"), jEnrVoy.getValeur("imageBatVoyageur"), chargerLesEquipements(Integer.parseInt(jEnr.getValeur("idbateau")))) ;
        		lesBateaux.add(monBatVoy) ;
        	}
        }while(!jEnr.fin()) ;
        jEnr.fermer() ;
		return lesBateaux ;
    }
    
}
