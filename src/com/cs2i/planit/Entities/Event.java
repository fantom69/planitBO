package com.cs2i.planit.Entities;

import java.sql.Date;

public class Event {
	private int id;
	private String titre;
	private String description;
	private Date dateDebut;
	private Date dateFin;
	private String ville;
	private String adresse;
	
	private Product[] productsRequired;
	
	public Event(int id, String titre, String description, Date dateDebut, Date dateFin, String ville, String adresse) {
		this.id = id;
		this.titre = titre;
		this.description = description;
		this.dateDebut = dateDebut;
		this.dateFin = dateFin;
		this.ville = ville;
		this.adresse = adresse;
	}
	
	
}
