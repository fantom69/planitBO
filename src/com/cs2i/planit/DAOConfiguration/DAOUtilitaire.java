package com.cs2i.planit.DAOConfiguration;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import com.cs2i.planit.Entities.User;

public class DAOUtilitaire {
	/*
     * Constructeur caché par défaut (car c'est une classe finale utilitaire,
     * contenant uniquement des méthode appelées de manière statique)
     */
    private DAOUtilitaire() {
    }

    /* Fermeture silencieuse du resultset */
    public static void destructionConnexion( ResultSet resultSet ) {
        if ( resultSet != null ) {
            try {
                resultSet.close();
            } catch ( SQLException e ) {
                System.out.println( "Échec de la fermeture du ResultSet : " + e.getMessage() );
            }
        }
    }

    /* Fermeture silencieuse du statement */
    public static void destructionConnexion( Statement statement ) {
        if ( statement != null ) {
            try {
                statement.close();
            } catch ( SQLException e ) {
                System.out.println( "Échec de la fermeture du Statement : " + e.getMessage() );
            }
        }
    }

    /* Fermeture silencieuse de la connexion */
    public static void destructionConnexion( Connection connexion ) {
        if ( connexion != null ) {
            try {
                connexion.close();
            } catch ( SQLException e ) {
                System.out.println( "Échec de la fermeture de la connexion : " + e.getMessage() );
            }
        }
    }

    /* Fermetures silencieuses du statement et de la connexion */
    public static void destructionConnexion( Statement statement, Connection connexion ) {
    	destructionConnexion( statement );
    	destructionConnexion( connexion );
    }

    /* Fermetures silencieuses du resultset, du statement et de la connexion */
    public static void destructionConnexion( ResultSet resultSet, Statement statement, Connection connexion ) {
    	destructionConnexion( resultSet );
    	destructionConnexion( statement );
    	destructionConnexion( connexion );
    }
    
    public static User map( ResultSet resultSet ) throws SQLException {

        User utilisateur = new User();
        utilisateur.setId(resultSet.getInt("idUtilisateur"));
        utilisateur.setMail(resultSet.getString("mail"));
        utilisateur.setPassword(resultSet.getString( "password" ));
        utilisateur.setNom(resultSet.getString( "nom" ));
        utilisateur.setPrenom(resultSet.getString( "prenom" ));
        return utilisateur;

    }
    
    public static PreparedStatement initialisationRequetePreparee( Connection connexion, String sql, boolean returnGeneratedKeys, Object... objets ) throws SQLException {
        PreparedStatement preparedStatement = connexion.prepareStatement( sql, returnGeneratedKeys ? Statement.RETURN_GENERATED_KEYS : Statement.NO_GENERATED_KEYS );

        for ( int i = 0; i < objets.length; i++ ) {
            preparedStatement.setObject( i + 1, objets[i] );
        }
        return preparedStatement;

    }
}
