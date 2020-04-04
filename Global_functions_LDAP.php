<?
// LDAP connection
function LDAPConnect()
{
	$LDAPServer = "localhost"; //todo goedzetten naar juiste domain
	$ldap = ldap_connect($LDAPServer);
	if($ldap) 
	{ echo "Connected";}
	return $ldap;
}
// LDAP LOGIN
function LDAPLogin($ldap)
{
	$username ="cn=Manager,dc=ritsema,dc=frl";
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
	if($ldap)
	{echo "connected2";}
	$password = "secret";
	$bind = ldap_bind($ldap,$username,$password);
	if($bind) {
		echo "bind";
		$filter="(uid=$username)";
		$result = ldap_search($ldap,"dc=ritsema,dc=frl",$filter);
		ldap_sort($ldap,$result,"sn");
		$info = ldap_get_entries($ldap, $result);
		for ($i=0; $i<$info["count"]; $i++)
		{
			if($info['count'] > 1)
			{
				header("Location: Gekukt.php");
				break;
		}		
			else 
			{
				$msg = "Invalid email address / password";
				

			}   

		}
	}
else {echo "not bound";}

}


?>
