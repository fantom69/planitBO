package com.cs2i.planit.Entities;

public class User {
	
	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public String getPrenom() {
		return prenom;
	}

	public void setPrenom(String prenom) {
		this.prenom = prenom;
	}

	public String getMail() {
		return mail;
	}

	public void setMail(String mail) {
		this.mail = mail;
	}

	public User[] getFriends() {
		return friends;
	}

	public void setFriends(User[] friends) {
		this.friends = friends;
	}

	private int id;
	private String password;
	private String nom;
	private String prenom;
	private String mail;

	
	private User[] friends;
	
	public User(int id, String nom, String prenom, String mail, String password ){
		this.id = id;
		this.nom = nom;
		this.prenom = prenom;
		this.mail = mail;
		this.password = password;
	}
	
	public User(String nom, String prenom, String mail, String password ){
		
	}

	public User() {

	}
}
