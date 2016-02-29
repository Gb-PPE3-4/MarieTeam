import java.sql.* ;

public class ParametreBDD {
    
    private String user ;
    private String mdp ;
    private String serveur ;
    private String driverSGBD ;
    private Connection connexion = null;
    
    // Constructeur avec NOM, MDP, SERVEUR, DRIVER
    public ParametreBDD(String nom, String mdp, String serveur, String driver) throws ClassNotFoundException, SQLException{
    	this.user = nom ;
    	this.mdp = mdp ;
    	this.serveur = serveur ;
    	this.driverSGBD = driver ;
    }
    
    
    // Connexion a la BDD
    public void seConnecterBDD() throws ClassNotFoundException, SQLException{
        Class.forName(driverSGBD);
        this.connexion = DriverManager.getConnection(serveur, user, mdp) ;
    }
    // Deconnexion de la BDD
    public void seDeconnecterBDD() throws ClassNotFoundException, SQLException{
        this.connexion.close() ;
    }
    
    // Requete SQL de lecture avec possible clause WHERE
    public ResultSet reqLecture(String reqSelect) throws  ClassNotFoundException, SQLException{
    	seConnecterBDD() ;
    	ResultSet jEnr = this.connexion.createStatement().executeQuery(reqSelect) ;
        return jEnr ;
    }
    
    // Getters & Setters
	public String getUser() {
		return user;
	}
	public void setUser(String user) {
		this.user = user;
	}
	public String getMdp() {
		return mdp;
	}
	public void setMdp(String mdp) {
		this.mdp = mdp;
	}
	public String getServeur() {
		return serveur;
	}
	public void setServeur(String serveur) {
		this.serveur = serveur;
	}
	public String getDriverSGBD() {
		return driverSGBD;
	}
	public void setDriverSGBD(String driverSGBD) {
		this.driverSGBD = driverSGBD;
	}
	public Connection getConnexion() {
		return connexion;
	}
	public void setConnexion(Connection connexion) {
		this.connexion = connexion;
	}
}
