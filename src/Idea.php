<?php

$mediaLibrary = new MediaLibrary();

$mediaLibrary
  ->add($request->image)
  ->backup();
