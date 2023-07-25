import discord
from discord.ext import commands

# Токен вашего бота
TOKEN = 'MTEyNTgwMTY1MTQ1OTA3MjExMA.GXGgbR.HP2hbrx7VhC1ZcmjmYD8OTohPoXPzW_oxjFEdk'
# ID вашего сервера
GUILD_ID = 1123971136611422210
# ID текстового канала
CHANNEL_ID = 1124211118513066004
# ID сообщения с реакцией
MESSAGE_ID = 1125823362015428628
# ID роли, которую нужно выдать
ROLE_ID = 1123971426387492955
# Название реакции
REACTION_NAME = '🔥'

intents = discord.Intents.default()
intents.reactions = True

bot = commands.Bot(command_prefix='!', intents=intents)


@bot.event
async def on_ready():
    print(f'Logged in as {bot.user.name} ({bot.user.id})')
    print('------')


@bot.event
async def on_raw_reaction_add(payload):
    if payload.message_id == MESSAGE_ID and payload.emoji.name == REACTION_NAME:
        guild = bot.get_guild(GUILD_ID)
        member = await guild.fetch_member(payload.user_id)
        role = guild.get_role(ROLE_ID)
        await member.add_roles(role)


@bot.event
async def on_raw_reaction_remove(payload):
    if payload.message_id == MESSAGE_ID and payload.emoji.name == REACTION_NAME:
        guild = bot.get_guild(GUILD_ID)
        member = await guild.fetch_member(payload.user_id)
        role = guild.get_role(ROLE_ID)
        await member.remove_roles(role)


bot.run(TOKEN)