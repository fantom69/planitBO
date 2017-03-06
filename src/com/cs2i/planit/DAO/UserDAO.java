package com.cs2i.planit.DAO;

import com.cs2i.planit.DAOConfiguration.DAOException;
import com.cs2i.planit.Entities.User;

public interface UserDAO {
	void creer( User utilisateur) throws DAOException;

    User getUserByEmail(String email) throws DAOException;
}
