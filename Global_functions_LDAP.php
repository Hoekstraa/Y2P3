<?
// LDAP connection
function LDAPConnect()
{
	$LDAPServer = "localhost"; //todo goedzetten naar juiste domain
	$ldap = ldap_connect($LDAPServer);
	return $ldap;
}

// LDAP LOGIN
function LDAPLogin()
{
    $username = $_POST['username'];
	$password = $_POST['password'];
	$ldaprdn = 'mydomain' . "\\" . $username;
	$bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=ritsema,dc=frl",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            echo '<pre>';
            var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0]; 
        }
        @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }

}
else
{

}
?>