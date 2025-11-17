<?php
session_destroy();
flash("Déconnexion réussie.", "success");
redirect('/login');