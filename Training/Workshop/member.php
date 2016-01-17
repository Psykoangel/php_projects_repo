<?php

class Member
{
    private $pseudo;
    private $mpd;
    
    public function getPseudo()
    {
        return $this->pseudo;
    }
    
    public function getMdp()
    {
        return $this->mpd;
    }
    
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    
    public function setMdp($mdp)
    {
        $this->mpd = $mdp;
    }
}
