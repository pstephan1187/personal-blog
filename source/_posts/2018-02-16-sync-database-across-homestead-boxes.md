---
title: How to Persist Databases Across Homestead Instances
slug: Prevent losing your databases after destroying your vagrant box
url: how-to-persist-databases-across-homestead-instances
date: 2018-02-16
image: tim-trad-234170.jpg
image_link: https://unsplash.com/photos/CLm3pWXrS9Q
photographer: Tim Trad
---

There can be many reasons why you have to destroy your homestead box and start over. Of course, that is one of the benefits to using a virtual machine, it is supposed to be disposable. But often times, we avoid destroying the box as much as possible because doing so will destroy any databases on the box.

Many times, you have data in there you don't want to have to recreate. So how do you save your database? One possible method is to dump your database into a `.sql` file and then re-import it in your new box. Of course, this can be time consuming if you have gigabytes worth of database data.

Another method, that I will outline here, is to sync the database files directly from your local machine to the homestead box. This is very similar to the way you sync your site application files.

## Syncing Your Database to your Local Machine

Firstly, you need to get the database files to your local machine. We will need to set up a folder to sync down the database files. If we try to immediatly sync down the mysql data folder, we will delete the files, so we will need to sync to a secondar folder first to pull down the data:

```yaml
folders:
    # ...
    - map: ~/Databases/Homestead
      to: /var/lib/mysql-sync
      options:
        owner: mysql
        group: mysql
```

Then SSH into the box, copy (or move) the database files over, then destroy the box (make sure the database files have all backed up to your local folder and back up anything else you need to).

```
vagrant ssh
sudo su -
cp -R /var/lib/mysql/* /var/lib/mysql-sync/
exit
exit
vagrant destroy
```

We will now update the folder syncing to write the database files to the mysql data directory and add a provisioning command to restart mysql. You have to restart mysql so that the mysql server knows about your new files after `vagrant up`ing a box.

Update your Homestead.yaml file:

```yaml
folders:
    #...
    - map: ~/Databases/Homestead
      to: /var/lib/mysql
      options:
        owner: mysql
        group: mysql
```

Add the following line to your after.sh file:

```
sudo service mysql restart
```

Now run `vagrant up` and you should be good to go.

Note that one thing to keep in mind is that this may cause problems when upgrading your box due to differences in mysql versions. You will need to keep that in consideration. One thing that you could do is upgrade mysql before destroying your old box.

I hope you find this helpful. It has already saved me some trouble when upgrading my homestead box recently.
