<?
// Global variables
$Session_name_Emp = "sfL0wrpQD2VD4BXaYzJGRW2HUILMUNmny3zGg40cTBDREiF56e5W6ZridAVHP3aRQq2Fv74N4ybPe2nYPly3OQ4cdKmLDOjUDJyQ";

// LDAP connection
function LDAPConnect()
{
	$LDAPServer = "localhost"; 
	$ldap = ldap_connect($LDAPServer);
	return $ldap;
}

// LDAP LOGIN
function LDAPLogin()
{
    $username = $_POST['username'];
    $EncryptedUsername = base64_encode($username);
	$password = $_POST['password'];
	$ldaprdn = 'ritsema' . "\\" . $username;
	$bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=ritsema,dc=frl",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
            {
                break;
                $_SESSION[$Session_name_Emp] = $EncryptedUsername;
            }
        
            
        @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }

}
// Get userid 
function GetUserIDLdap()
{

}

?>