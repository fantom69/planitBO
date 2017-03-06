package com.cs2i.planit.RestServices;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.Status;

import com.cs2i.planit.DAOConfiguration.DAOFactory;
import com.cs2i.planit.DAO.UserDAO;
import com.cs2i.planit.Entities.User;

@Path("/login")
public class authentificationRestService{
	

	@GET
	public String getMessage(){
		String message="dont work";
	/*	
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		}
		
		String url = "jdbc:mysql://localhost:3306/planit?serverTimezone=UTC";

		String utilisateur = "root";

		String motDePasse = "";
		String message="dont work";

		Connection connexion = null;
		Statement statement = null;
		ResultSet resultat = null;

		try {
			
			connexion = DriverManager.getConnection( url, utilisateur, motDePasse );
			statement = connexion.createStatement();
			resultat = statement.executeQuery( "SELECT idUtilisateur, mail, nom, prenom, password  FROM t_utilisateur;" );
			

			while ( resultat.next() ) {
				user.setId(resultat.getInt("idUtilisateur"));
				user.setMail(resultat.getString("mail"));
				user.setNom(resultat.getString("nom"));
				user.setPrenom(resultat.getString("prenom"));
				user.setPassword(resultat.getString("password"));

			}
			
			System.out.println(user.getMail());
		   
		} 
		catch ( SQLException e ) {
			System.out.println(e);
		} 
		finally {
			if ( resultat != null ) {
		        try {
		            resultat.close();
		        } catch ( SQLException ignore ) {
		        }
		    }
		    if ( statement != null ) {
		        try {
		            statement.close();
		        } catch ( SQLException ignore ) {
		        }
		    }
		    if ( connexion != null ) {
		        try {
		            connexion.close();
		        } catch ( SQLException ignore ) {
		        }
		    }
		}*/

		
		return message;
	}
}
