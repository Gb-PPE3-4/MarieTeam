import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Container;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent ;
import java.awt.event.MouseListener ;
import java.util.ArrayList;

import javax.swing.BoxLayout;
import javax.swing.JButton;
import javax.swing.JCheckBox;
import javax.swing.JFrame ;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JPanel;
import javax.swing.JTextField;
public class Fenetre extends JFrame implements ActionListener{

	// TRAITEMENT
	private ArrayList<BateauVoyageur> listBateaux = new ArrayList<BateauVoyageur>() ;
	private ArrayList<BateauVoyageur> listBateauxSlcted = new ArrayList<BateauVoyageur>() ; 
	// GUI
	// PANELS
    private JPanel panelGaucheList = new JPanel() ;
	private JPanel panelDroiteList = new JPanel() ;
	// BOUTONS
	private JButton boutonAjouter = new JButton("Ajouter") ;
	private JButton boutonRetirer = new JButton("Retirer") ;
	private JButton boutonEditer = new JButton("Editer") ;
	// LABELS
	private JLabel libTitre = new JLabel("     Edition de brochure de bateaux") ;
	private JLabel libBatSlct = new JLabel("     Liste des bateaux :") ;
	private JLabel libBatSlcted = new JLabel("     Bateaux sélectionnés :") ;
	// LISTES
	//private JList listBatSlct = new JList() ;
	//private JList listBatSlcted = new JList() ;
	
	public Fenetre(ArrayList<BateauVoyageur> listBateaux){
		setSize(500,450) ;
		setTitle("Edition de brochure") ;
		
		this.listBateaux = listBateaux ;
		
		Container cPane = getContentPane() ;
		cPane.setBackground(new Color(0, 114, 255)); 
		cPane.setLayout(new BorderLayout());

		// En-tête
		libTitre.setPreferredSize(new Dimension(50, 50)) ;
		libTitre.setForeground(Color.white);
		cPane.add(libTitre, BorderLayout.PAGE_START);
        
        // A gauche LIBELLE & LISTE
        panelGaucheList.setBackground(Color.white); 
        panelGaucheList.setLayout(new BoxLayout(panelGaucheList, BoxLayout.Y_AXIS));
        //panelGaucheList.setBounds(10, 10, 240, 200);
        libBatSlct.setPreferredSize(new Dimension(200, 100)) ;
        panelGaucheList.add(libBatSlct) ;
        //listBatSlct.setPreferredSize(new Dimension(100, 50)) ;
        //panelGaucheList.add(listBatSlct) ;
        // APPEL CONSTRUCTION LIST BATEAU DANS PANEL
        addListBat() ;
        cPane.add(panelGaucheList, BorderLayout.LINE_START);

		// Au centre
       /* JPanel panelCentre = new JPanel() ;
        panelCentre.setBackground(Color.white); 
        panelCentre.setLayout(new BoxLayout(panelCentre, BoxLayout.Y_AXIS));
        panelCentre.setBounds(10, 10, 200, 200);
        boutonAjouter.setPreferredSize(new Dimension(200, 100)) ;
        boutonRetirer.setPreferredSize(new Dimension(200, 100)) ;
        panelCentre.add(boutonAjouter) ;
        panelCentre.add(boutonRetirer) ;
        cPane.add(panelCentre, BorderLayout.CENTER);*/
        
        // A droite LIBELLE & LISTE
        panelDroiteList.setBackground(Color.white); 
        panelDroiteList.setLayout(new BoxLayout(panelDroiteList, BoxLayout.Y_AXIS));
        //panelDroiteList.setBounds(10, 10, 240, 200);
        libBatSlcted.setPreferredSize(new Dimension(200, 100)) ;
        panelDroiteList.add(libBatSlcted) ;
        //listBatSlcted.setPreferredSize(new Dimension(100, 50)) ;
        //panelDroiteList.add(listBatSlcted) ;
        cPane.add(panelDroiteList, BorderLayout.LINE_END);

        // Bas de page       
        cPane.add(boutonEditer, BorderLayout.PAGE_END);
				
	}
	
	// Récupère la liste des bateaux et les affiche les uns après les autres 
	public void addListBat(){
		JLabel bateau ;
		for( BateauVoyageur unBateau : this.listBateaux ){
			bateau = new JLabel(unBateau.getNom()) ;
			// TODO ajouter ecouteur
			this.panelGaucheList.add(bateau) ;
		}
	}
	
	public void ajoutBateauAList(BateauVoyageur bateau){
		this.listBateauxSlcted.add(bateau) ;
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0) {
		// TODO Auto-generated method stub
		
	}

}
