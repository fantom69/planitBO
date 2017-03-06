package com.cs2i.planit.DAOImplentation;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import static com.cs2i.planit.DAOConfiguration.DAOUtilitaire.*;
import com.cs2i.planit.DAO.UserDAO;
import com.cs2i.planit.DAOConfiguration.DAOException;
import com.cs2i.planit.DAOConfiguration.DAOFactory;
import com.cs2i.planit.Entities.User;

public class UserDAOImpl implements UserDAO {
	
	private DAOFactory daoFactory;


    public UserDAOImpl( DAOFactory daoFactory ) {
        this.daoFactory = daoFactory;
    }
	
    private static final String SQL_SELECT_PAR_EMAIL = "SELECT id, mail, nom, prenom, password FROM t_utilisateur WHERE mail = ?";

    @Override
    public User getUserByEmail(String email) throws DAOException {

        Connection connexion = null;
        PreparedStatement preparedStatement = null;
        ResultSet resultSet = null;
        User utilisateur = null;


        try {
            connexion = daoFactory.getConnection();
            
            preparedStatement = initialisationRequetePreparee( connexion, SQL_SELECT_PAR_EMAIL, false, email );
            resultSet = preparedStatement.executeQuery();

            /* Parcours de la ligne de donn�es de l'�ventuel ResulSet retourn� */

            if(resultSet.next()) {
                utilisateur = map( resultSet );
            }            
        } catch ( SQLException e ) {
            throw new DAOException( e );
        } finally {
            destructionConnexion( resultSet, preparedStatement, connexion );
        }
        return utilisateur;
    }
    
    @Override
    public void creer( User utilisateur ) throws DAOException {

        Connection connexion = null;
        PreparedStatement preparedStatement = null;
        ResultSet valeursAutoGenerees = null;

        try {

            /* R�cup�ration d'une connexion depuis la Factory */
            connexion = daoFactory.getConnection();
            //preparedStatement = initialisationRequetePreparee( connexion, SQL_INSERT, true, utilisateur.getEmail(), utilisateur.getMotDePasse(), utilisateur.getNom() );

            //int statut = preparedStatement.executeUpdate();

            /* Analyse du statut retourn� par la requ�te d'insertion */
            /*if ( statut == 0 ) {
                throw new DAOException( "�chec de la cr�ation de l'utilisateur, aucune ligne ajout�e dans la table." );
            }*/

            /* R�cup�ration de l'id auto-g�n�r� par la requ�te d'insertion */

            /*valeursAutoGenerees = preparedStatement.getGeneratedKeys();
            if ( valeursAutoGenerees.next() ) {
                utilisateur.setId( valeursAutoGenerees.getLong(1) );
            } else {
                throw new DAOException( "�chec de la cr�ation de l'utilisateur en base, aucun ID auto-g�n�r� retourn�." );
            }*/

        } catch ( SQLException e ) {
            throw new DAOException( e );
        } finally {
            //fermeturesSilencieuses( valeursAutoGenerees, preparedStatement, connexion );
        }

    }

}
