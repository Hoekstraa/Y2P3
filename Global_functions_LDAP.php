<?
// LDAP connection
function LDAPConnect()
{
	$LDAPServer = "localhost"; //todo goedzetten naar juiste domain
	$ldap = ldap_connect($LDAPServer);
	return $ldap;
}
// LDAP LOGIN
function LDAPLogin($ldap)
{
	$username ="cn=Manager,dc=ritsema,dc=frl";
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
	$password = "secret";
    $bind = ldap_bind($ldap,$username,$password);
    // Pull username from post request
	$Uname = $_POST['username'];
	// Pull Passwd from post request
	$Passwd = $_POST['password'];
    $attrs = ldap_get_attributes($ldap, "uid=$Uname,ou=Intranet,dc=ritsema,dc=frl");
    for ($i=0; $i < $attrs["count"]; $i++) {
        echo $attrs[$i] . "<br />";
    }

}


?>
