<?php

namespace Pep;

class GmailStripper {

  public static function strip($email, array $domains = ['gmail', 'googlemail']) {
    $domainString = implode('|', $domains);
    if (preg_match("/\@({$domainString})/", $email)) {
      if (preg_match('/[a-zA-Z0-9_\.]+/', $email)) {
        $explodedEmail = explode('@', $email);
        $email = preg_replace('/\./', '', $explodedEmail[0]) . "@{$explodedEmail[1]}";
      }
      if (preg_match('/\+/', $email)) {
        $explodedEmail = explode('+', $email);
        $name = array_shift($explodedEmail);
        $plusPart = implode('', $explodedEmail);
        $domain = explode('@', $plusPart)[1];
        $email = "$name@$domain";
      }
    }

    return $email;
  }

}