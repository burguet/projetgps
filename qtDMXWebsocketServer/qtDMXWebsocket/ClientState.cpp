#include "ClientState.h"

// [Constructeur]
ClientState::ClientState()
{
	authenticated = false;
	username = nullptr; // nullptr
}

// [M�thode pour savoir si le client est connecter]
bool ClientState::isAuthenticated()
{
	if (authenticated == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

// [M�thode pour changer l'authentification et l'username]
void ClientState::setAuthenticated(bool newAuthenticated, QString newUsername)
{
	this->authenticated = newAuthenticated;
	this->username = newUsername;
}