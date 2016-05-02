


import static org.junit.Assert.*;

import java.util.ArrayList;

import org.junit.Before;
import org.junit.Test;

public class PasserelleTest {

	public Passerelle instancePass = new Passerelle() ;

	@Test
	public void testChargerLesEquipements() {
		try{
			// 3 equipements en base de donn�es pour le bateau d'id 1
			assertEquals("Tous les equipements n'ont pas �t� pris en compte.", 
					instancePass.chargerLesEquipements(1).size(),3) ;
		}catch(Exception e){
			System.out.println(e.getMessage());
		}
	}

	@Test
	public void testChargerLesBatVoy() {
		try{
			// 5 bateaux voyageurs en base de donn�es
			assertEquals("Tous les bateaux n'ont pas �t� charg�s.", instancePass.chargerLesBatVoy().size(),5) ;
		}catch(Exception e){
			System.out.println(e.getMessage());
		}
	}

}
